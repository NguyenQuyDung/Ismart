<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use LDAP\Result;
use Illuminate\Support\Facades\Auth;

class AdminCommentController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'comment']);
            return $next($request);
        });
    }
    public function list_comment(Request $request)
    {
      
        $count_pending_comment = Comment::where('comment_status', 0)->count();
        $count_danger_comment = Comment::where('comment_status', 1)->count();
        $comments = Comment::with('product')->where('comment_parent_comment', '=', 0)->orderBy('comment_status', 'DESC')->paginate(10);
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->orderBy('id', 'DESC')->get();
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $comments = Comment::with('product')->where('comment_name', 'LIKE', "%{$keyword}%")->where('comment_parent_comment', '=', 0)->orderBy('comment_status', 'DESC')->paginate(10);
        return view('admin.comment.list_comment')->with(compact('comment_rep', 'comments', 'count_pending_comment', 'count_danger_comment'));
    }
    // phê duyệt  bình luận hoặc chờ duyệt bình luận
    public function update_comment(Request $request)
    {
        $data = $request->all();
        $comments = Comment::find($data['comment_id']);
        $comments->comment_status = $data['commnent_status'];
        $comments->save();
    }
    // phản hồi đánh giá của khách hàng tại ismart
    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comments = new Comment;
        $comments->comment = $data['commnent'];
        $comments->comment_product_id = $data['comment_product_id'];
        $comments->comment_parent_comment = $data['comment_id'];
        $comments->comment_status = 0;
        $comments->comment_name = 'DũngIsmart';
        $comments->save();
    }
    // xóa comment sản phẩm
    public function delete_comment(Request $request, $id)
    {
        $delete_comment = Comment::find($id);
        $delete_comment->delete();
        return redirect('admin/comment/list')->with('status', 'Đã Xóa Comment Đánh Gía Sản Phẩm Thành Công !');
    }
    //
}
