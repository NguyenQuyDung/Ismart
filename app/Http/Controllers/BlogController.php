<?php

namespace App\Http\Controllers;

use App\Post;
use App\Product;
use App\PostCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    //
    public function blog()
    {
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $category = PostCat::all();
        $parent_menus = PostCat::where(['parent_id' => 0])->get();
        $blogs = Post::paginate(4);
        return view('Users.blog', compact('blogs', 'parent_menus', 'category', 'featured_products'));
    }
    public function detail_blog($nameCat)
    {
        $category = PostCat::all();
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $posts_blog = Post::where('name', $nameCat)->first();
       // dd($posts_blog);
        return view('Users.detail_blog', compact('posts_blog', 'category', 'featured_products'));
    }
    // dùng đệ quy để lấy bài viết thuộc slug theo dnah mục bài viết
    public function show_data($data)
    {
        echo "<prev>";
        print_r($data);
        echo "</prev>";
    }
    public function searchChildren($data, $id, &$child){
        foreach($data as $item){
            if($item['parent_id'] == $id){
                $child[] = $item['id'];
                $this->searchChildren($data, $item['id'], $child);
            }
        }
    }
    public function post_list(Request $request,$slug)
    {
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $category = PostCat::all();
        $posts = Post::all();
        $post_cat = PostCat::where('slug', $slug)->first();
        $this_cat_id = $post_cat->id;
        $data = PostCat::all();
        $child[] = $this_cat_id;
        $this_cat_name = $post_cat->name;
        $this->searchChildren($data, $this_cat_id, $child);
        $list_posts = Post::whereIn('cat_id', $child)->get();
        return view('Users.category_post1', compact('category', 'featured_products',
      'posts', 'list_posts', 'this_cat_name' ));
    }
}
