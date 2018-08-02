<?php
namespace Common\Tag;
use Think\Template\TagLib;
class My extends TagLib {
    // 定义标签
    protected $tags = array(
        // 标签定义：attr 属性列表 close 是否闭合(0或1 默认1) alias 标签别名 level 嵌套层次
        'ueditor'   => array('attr'=>'name,content','close'=>0),
        'recommend' => array('attr'=> 'limit','level'=>1)
    );
    /**
     * 引入ueidter编辑器
     * @param string $tag name:表单name content:编辑器初始化后 默认内容
     */
    public function _ueditor($tag){
        $name = $tag['name'];
        $content = $tag['content'];
        $link = <<<php
<script id="container" name="$name" type="text/plain">
$content
</script>
<script type="text/javascript" src="__PUBLIC__/static/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/ueditor1_4_3/ueditor.all.js"></script>
<script type="text/javascript">
var ue = UE.getEditor('container');
</script>
php;
        return $link;
    }
    // 置顶推荐文章标签 cid为空时则抓取全部分类下的推荐文章
    public function _recommend($tag,$content){
        if(empty($tag['cid'])){
            $where = "is_show=1 and is_delete=0 and is_top=1";
        }else{
            $where = "is_show=1 and is_delete=0 and is_top=1 and cid=".$tag['cid'];
        }
        $limit = $tag['limit'];
        // p($recommend);
        $php = <<<php
<?php
            \$recommend = M('Article')->field('aid,title')->where("$where")->limit($limit)->select();
            foreach(\$recommend as \$k => \$field) {
                \$url = U('Home/Index/article',array('aid'=>\$field['aid']));
?>
php;
        $php .= $content; // 拼字符串的过程。。。
$php .= '<?php } ?>'; // foreach的回扩
return $php;
    }
}