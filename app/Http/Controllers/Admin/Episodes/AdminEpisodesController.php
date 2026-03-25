<?php

namespace App\Http\Controllers\Admin\Episodes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Episode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Session;
class AdminEpisodesController extends EpisodeMainController
{
    public function indexEpisodes()
    {
        $episodes = Episode::orderBy('number', 'asc')->get();
        return view('episodes.index', compact('episodes'));
    }
    public function allCourseEpisodes($id)
    {
        $course = Course::findOrFail($id);
        $episodes = $course->episodes->where('deleted_at','==',null)->sortBy('episode_number');

        return view('episodes.all', compact('episodes','course'));
    }

    public function createNewEpisode($id)
    {
        $courseId = $id;
        $course = Course::findOrFail($id);
        return view('episodes.create', compact('course','courseId'));
    }

    public function storeNewEpisode(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
        ]);

        if (!$request->has('manual_slug') || !$request->input('manual_slug')) {
            $validated['slug'] = \Str::slug($request->input('slug'));
        } else {
            $validated['slug'] = \Str::slug($request->input('title'));
        }

        $courseId = $request->input('course_id');

        $episode = Episode::where('course_id', $courseId)
            ->where('slug', $validated['slug'])
            ->first();

        if (!$episode) {
            $episode = new Episode();
            $episode->course_id = $courseId;
            $episode->slug = $validated['slug'];
            $episode->title = $request->input('title');
            $episode->type = $request->input('type');

            if ($request->has('manual_episode_number')) {
                $episode->episode_number = $request->input('number');
            } else {
                $latestEpisode = Episode::where('course_id', $courseId)->max('episode_number');
                $episode->episode_number = $latestEpisode ? $latestEpisode + 1 : 1;
            }

            if ($request->has('add_video_url') && $request->filled('video_url')) {
                $episode->video_url = $request->input('video_url');
            }

            if ($request->has('manual_duration') && $request->filled('manual_duration')) {
                $episode->time = $request->input('time');
            } else {
                if ($request->hasFile('video_file')) {
                    $videoLength = $this->getVideoLength($request->file('video_file'));

                    $formattedTime = $this->formatTimeToHHMMSS($videoLength);
                    $episode->time = $formattedTime;
                }
            }

            $episode->save();
        } else {
            return redirect()->back()->withErrors('This episode already exists.');
        }

        if ($request->hasFile('video_file') && !$episode->video_path) {
            $file = $request->file('video_file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path("courses/{$courseId}/episodes/{$episode->id}/video");

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $fileName);

            $episode->video_path = "courses/{$courseId}/episodes/{$episode->id}/video/{$fileName}";
            $episode->save();
        }

        return redirect()->route('adm.crs.epi.index', $courseId)->with('success', 'Episode uploaded successfully.');
    }

    public function editEpisode($courseId,$episodeId)
    {
        $episode = Episode::findOrFail($episodeId);
        return view('episodes.edit', compact('episode'));
    }

    public function updateEpisode(Request $request, $id)
    {
        $episode = Episode::findOrFail($id);

        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'show_status' => 'required|boolean',
            'description' => 'nullable|string',
            'body' => 'nullable|string',
            'video_url' => 'nullable|url|max:255',
            'video_path' => 'nullable|file|mimetypes:video/*',
            'thumb_path' => 'nullable|image|max:2048',
            'tags' => 'nullable|string|max:255',
            'time' => 'required|string|max:15',
            'number' => 'nullable|integer',
            'download_available' => 'required|boolean',
            'episode_number' => 'required|integer',
            'episode_iframe' => 'nullable|string|max:255',
        ]);

        $courseId = $request->input('course_id');
        $episodeId = $episode->id;

        $basePath = public_path("courses/$courseId/episodes/$episodeId");

        if (!File::exists($basePath . '/thumb')) {
            File::makeDirectory($basePath . '/thumb', 0755, true);
        }

        if (!File::exists($basePath . '/video')) {
            File::makeDirectory($basePath . '/video', 0755, true);
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumb_path')) {
            $thumbFile = $request->file('thumb_path');
            $thumbName = Str::random(10) . '.' . $thumbFile->getClientOriginalExtension();
            $thumbFile->move($basePath . '/thumb', $thumbName);
            $data['thumb_path'] = "courses/$courseId/episodes/$episodeId/thumb/$thumbName";
        }

        // Handle video upload
        if ($request->hasFile('video_path')) {
            $videoFile = $request->file('video_path');
            $videoName = Str::random(10) . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move($basePath . '/video', $videoName);
            $data['video_path'] = "courses/$courseId/episodes/$episodeId/video/$videoName";
        }

        $episode->update($data);
        return redirect("/courses/{$data['course_id']}/episodes/all")
            ->with('success', 'Episode updated successfully.');
    }


    public function deleteEpisode(Request $request, $crs, $epi)
    {
        $episode = Episode::findOrFail($epi);
        $episode->deleted_at = now();
        $episode->save();

        return redirect()->route('adm.crs.epi.index', $crs)->with('success', 'Episode deleted successfully.');
    }
}
