<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $article = Article::findOrFail($articleId);

        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        // Notify article author if someone else commented
        if (auth()->id() !== $article->user_id && !$request->parent_id) {
            \App\Models\Notification::create([
                'user_id' => $article->user_id,
                'type' => 'new_comment',
                'message' => auth()->user()->name . ' mengomentari berita Anda "' . $article->title . '".',
                'link' => route('artikel.show', $article->id) . '#comment-' . $comment->id,
            ]);
        }
        
        // Notify parent comment author if this is a reply
        if ($request->parent_id) {
            $parentComment = Comment::find($request->parent_id);
            if ($parentComment && $parentComment->user_id !== auth()->id()) {
                \App\Models\Notification::create([
                    'user_id' => $parentComment->user_id,
                    'type' => 'new_reply',
                    'message' => auth()->user()->name . ' membalas komentar Anda di berita "' . $article->title . '".',
                    'link' => route('artikel.show', $article->id) . '#comment-' . $comment->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(Comment $comment)
    {
        // Only allow author of comment or admin to delete
        if (auth()->id() !== $comment->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        // Deleting a parent comment will logically delete its replies due to foreign key constraints or cascade
        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
