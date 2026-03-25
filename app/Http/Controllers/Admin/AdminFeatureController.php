<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tag;
use App\Mail\MessageSentMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Message;
use Session;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFeatureController extends Controller
{
    public function sendMessage($id)
    {
        $user = User::find($id);
        $admin = auth()->user();
        $users = User::where('super_user', 0)->get();
        $tags = Tag::all();

        return view('users.features.sendmessage', compact('admin','users','tags','user'));
    }
    public function submitSendMessage(Request $request, $id)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'send_type' => 'required|in:individual,group',
            'receiver_type' => 'required|in:admin,user',
            'priority' => 'required|in:normal,important,critical',
            'pinned' => 'required|boolean',
            'body' => 'required|string',
            'can_reply' => 'nullable|boolean',
            'send_mail' => 'nullable|boolean',
            'tag_id' => 'nullable|exists:tags,id',
            'attachment' => 'nullable|file|max:10240',
            'recipients' => 'nullable|array',
            'recipients.*' => 'exists:users,id'
        ]);

        // Upload attachment if exists
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('messages', 'public');
        }

        // Create the message
        $message = Message::create([
            'subject' => $validated['subject'],
            'send_type' => $validated['send_type'],
            'receiver_type' => $validated['receiver_type'],
            'sender_id' => auth()->id(),
            'body' => $validated['body'],
            'attachment' => $attachmentPath,
            'can_reply' => $request->has('can_reply'),
            'priority' => $validated['priority'],
            'pinned' => $validated['pinned'],
            'tag_id' => $validated['tag_id'] ?? null,
        ]);

        // Determine recipients
        if ($validated['send_type'] === 'group') {
            $recipientIds = $validated['recipients'] ?? [];

            if (!in_array($id, $recipientIds)) {
                $recipientIds[] = $id;
            }

            $message->recipients()->attach($recipientIds);
        } else {
            $recipientIds = [$id];
            $message->recipients()->attach($id);
        }

        // Send mail if requested
        if ($request->has('send_mail')) {
            $users = \App\Models\User::whereIn('id', $recipientIds)->get();

            foreach ($users as $user) {
                Mail::to($user->email)->send(new MessageSentMail($message, $user));
            }
        }

        return redirect()->route('adm.site.users.view', $id)->with('success', 'Message sent successfully.');
    }

    public function createTag()
    {
        $previousUrl = url()->previous();
        Session::flash('previous_url', $previousUrl);
        return view('tags.create');
    }

    public function submitTag(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:tags,title',
        ]);

        // Sanitize: replace spaces with underscores and lowercase the string
        $cleanTitle = strtolower(str_replace(' ', '_', $request->input('title')));

        $tag = new Tag();
        $tag->title = $cleanTitle;
        $tag->save();

        // Retrieve flashed URL from session
        $previousUrl = Session::get('previous_url', route('adm.site.tags.index'));

        if (str_contains($previousUrl, 'send-message')) {
            return redirect($previousUrl)->with('success', 'Tag created successfully.');
        }

        return redirect()->route('adm.site.tags.index')->with('success', 'Tag created successfully.');
    }

    public function indexTag()
    {
        return view('tags.index');
    }

    public function conversations($id)
    {
        $adminId = Auth::id();
        $user = User::findOrFail($id);

        $conversations = DB::table('messages')->where('sender_id',$adminId)->get();

        return view('conversations.index', compact('conversations', 'user', 'adminId'));
    }

    public function customConversation($user, $conversation)
    {
        $adminId = Auth::id();
        $user = User::findOrFail($user);
        $conversations = DB::table('messages')->where('sender_id',$adminId)->get();

        // Get all messages under a conversation/thread (if $conversation is a message ID)
        $messages = Message::where('id', $conversation)
            ->orWhereIn('id', function ($query) use ($conversation) {
                $query->select('message_id')
                    ->from('message_recipient')
                    ->where('message_id', $conversation);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('conversations.custom', compact('messages', 'user', 'adminId','conversations'));
    }

    public function sendReply(Request $request, $user, $conversation)
    {
        $request->validate([
            'body' => 'required|string|max:5000',
        ]);

        $adminId = Auth::id();

        DB::table('message_replies')->insert([
            'message_id' => $conversation,
            'sender_id' => $adminId,
            'reply' => $request->input('body'),
            'read' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('adm.site.users.conversations.custom', [
            'user' => $user,
            'conversation' => $conversation,
        ])->with('success', 'Reply sent.');
    }

}
