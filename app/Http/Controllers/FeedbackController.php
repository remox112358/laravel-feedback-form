<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;

use Illuminate\Support\Facades\{Auth, Storage};
use Carbon\Carbon;
use Mail;

use App\Mail\FeedbackSent;
use App\Models\{Feedback, User};

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
        $folder = 'feedbacks/' . Carbon::now()->format('Y-m-d');
        $file = $request->file('file');
        $path = $file ? $file->store($folder) : null;

        $feedback = Feedback::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'file'    => $path
        ]);

        Auth::user()->updateLastFeedback();

        self::sendFeedbackMessage($feedback);

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

    /**
     * Update the feedback viewed status.
     *
     * @param Feedback $feedback
     * @return void
     */
    public function view(Feedback $feedback)
    {
        $feedback->update([
            'viewed' => 1
        ]);

        return redirect()
                ->back()
                ->with('success', 'Сообщение #' . $feedback->id . ' было успешно просмотрено');
    }

    /**
     * Send feedback messages to users with admin permission.
     *
     * @param Feedback $feedback
     * @return void
     */
    public function sendFeedbackMessage(Feedback $feedback)
    {
        $admins = User::admin(1)->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new FeedbackSent($feedback, $admin));
        }
    }
}
