<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Mail;

use App\Mail\FeedbackSent;
use App\Models\Feedback;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $unviewedFeedbacks = Feedback::viewed(0)->orderBy('updated_at', 'desc')->get();
        $viewedFeedbacks = Feedback::viewed(1)->orderBy('updated_at', 'desc')->get();

        return view('admin.index', compact('unviewedFeedbacks', 'viewedFeedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        if (Auth::user()->isAdmin())
            return redirect()->route('feedbacks');

        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\FeedbackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {
        if (Auth::user()->isAdmin()) {
            return redirect()
                    ->route('home')
                    ->with('warning', 'Отправлять сообщение могут только пользователи без роли');
        }

        if (! Auth::user()->canSend()) {
            return redirect()
                ->route('home')
                ->with('danger', 'Отправка сообщений возможна не больше 1 раза в сутки');
        }

        $file = $request->file('file');
        $folderPath = 'feedbacks/' . Carbon::now()->format('Y-m-d');
        $path = $file ? $file->store($folderPath) : null;

        $feedback = Feedback::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'file'    => $path
        ]);

        $user = Auth::user();

        $user->update([
            'last_feedback' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $admins = User::where('is_admin', 1)->get();

        foreach ($admins as $admin) {
            Mail::to($admin)->send(new FeedbackSent($feedback, $admin));
        }

        return redirect()
                ->route('home')
                ->with('success', 'Ваше сообщение было успешно отправлено. Спасибо :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Feedback $feedback)
    {
        return view('admin.show', compact('feedback'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        Storage::delete($feedback->file);

        return redirect()
                ->route('feedbacks')
                ->with('success', 'Сообщение #' . $feedback->id . ' было успешно удалено');
    }

    public function view(Feedback $feedback)
    {
        $feedback->viewed = 1;
        $feedback->save();

        return redirect()
                ->back()
                ->with('success', 'Сообщение #' . $feedback->id . ' было успешно просмотрено');
    }
}
