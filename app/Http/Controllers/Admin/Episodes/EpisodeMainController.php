<?php

namespace App\Http\Controllers\Admin\Episodes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EpisodeMainController extends Controller
{
    protected function getVideoLength($videoFile)
    {
        $ffmpeg = \FFMpeg\FFMpeg::create();
        $video = $ffmpeg->open($videoFile->getRealPath());
        $format = $video->getFormat();
        return $format->get('duration');
    }

    protected function formatTimeToHHMMSS($timeInSeconds)
    {
        $hours = floor($timeInSeconds / 3600);
        $minutes = floor(($timeInSeconds % 3600) / 60);
        $seconds = round($timeInSeconds % 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
