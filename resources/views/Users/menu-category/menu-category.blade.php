@php
function showCats($category, $parent_id = 0, $class = 'list-item')
{
// LẤY DANH SÁCH CATE CON
$cate_child = [];
foreach ($category as $key => $item) {
// Nếu là chuyên mục con thì hiển thị
if ($item['parent_id'] == $parent_id) {
$cate_child[] = $item;
unset($category[$key]);
}
}

// HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
if ($cate_child) {
echo "<ul class={$class}>";
    foreach ($cate_child as $key => $value) {
    $link = route('product_list',$value['slug']);
    echo "<li><a href='{$link}'>{$value['name']}</a>";
        showCats($category,$value['id'], $class = 'sub-menu');
        echo '</li>';
    }
    echo '</ul>';
}
}
showCats($category);
@endphp