<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public const VIEW = 'pdf.data-report';
    public const FILE_NAME = 'DataReport.pdf';

    public static function getData(): array
    {
        $user = auth()->user();
        return [
            'title' => "Vartotojo $user->name paskyros duomenų ataskaita",
            'date' => date('Y-m-d h:m'),
            'user' => $user,
            'posts' => Post::withCount(['comments', 'likes'])->where('user_id', '=', $user->id)->get()
        ];
    }

    public function HTMLPreview()
    {
        return view(static::VIEW, self::getData());
    }

    public function preview()
    {
        $pdf = Pdf::loadView(static::VIEW, self::getData());
        return $pdf->stream(static::FILE_NAME);
    }

    public function download()
    {
        $pdf = Pdf::loadView(static::VIEW, self::getData());
        return $pdf->download(static::FILE_NAME);
    }
}
