<?php

namespace Blog\Model\Table;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression;

class BlogTable extends TableGateway {

  protected $tableGateway;
  protected $select;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
    $this->select = new Select();
  }

  public function fetch_all_blogs($keyword = null, $category_id = null, $tag_id = null) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                'blog_id',
                'category_id', 'author_id',
                'title' => "blog_title",
                'description' => "blog_short_desc",
                #'content' => "blog_content",
                'create_date' => 'written_date',
                'is_archive', 'is_publish', 'is_draft',
                'keywords' => new Expression(
                        "(SELECT GROUP_CONCAT(  `tag_name` ) 
                          FROM  `blogs_tags` 
                          WHERE tag_id
                          IN ( 
                            SELECT tag_id FROM blogs_tags_relationship WHERE blog_id =  blogs.blog_id 
                          ) 
                         )"
                ),
                'comments_count' => new Expression("(SELECT COUNT(*) FROM `blogs_comments` WHERE `blogs_comments`.`blog_id` = blogs.blog_id GROUP BY `blogs_comments`.`blog_id`)"),
                'images' => new Expression("(SELECT `image_url` FROM `blogs_images` WHERE `blogs_images`.`blog_id` = blogs.blog_id AND `image_type` = 'listing')")
            )
    );
    $select->join('users', 'users.user_id = blogs.author_id', array('author' => 'username'), 'left');
    $select->join('blogs_categories', 'blogs_categories.category_id = blogs.category_id', array('category' => 'category_title'), 'left');
    $select->order('blogs.blog_id DESC');
    if ($keyword) {
      $select->where->like('blog_title', "%{$keyword}%");
    }
    if ($tag_id) {
      $select->join('blogs_tags_relationship', 'blogs_tags_relationship.blog_id = blogs.blog_id', array(), 'left');
      $select->where(array("blogs_tags_relationship.tag_id" => $tag_id));
    }
    if ($category_id) {
      $select->where(array("blogs.category_id" => $category_id));
    }
    $resultSet = $this->tableGateway->selectWith($select);
    $resultSet->buffer();

    if ($resultSet) {
      return $resultSet;
    }
    return false;
  }

  public function fetch_blog($blog_id) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                'blog_id', 'category_id', 'author_id',
                'title' => "blog_title",
                'description' => "blog_short_desc",
                'content' => "blog_content",
                'create_date' => 'written_date',
                'is_archive', 'is_publish', 'is_draft',
                'keywords' => new Expression(
                        "(SELECT GROUP_CONCAT(CONCAT(`tag_id`, '::', `tag_name`))
              FROM `blogs_tags`
              WHERE tag_id
              IN(
              SELECT tag_id FROM blogs_tags_relationship WHERE blog_id = {$blog_id}
              )
              )"
                ),
                'images' => new Expression("(SELECT `image_url` FROM `blogs_images` WHERE `blogs_images`.`blog_id` = blogs.blog_id AND `image_type` = 'top_banner')")
            )
    );
    $select->join('users', 'users.user_id = blogs.author_id', array('author' => 'username'), 'left');
    $select->join('blogs_categories', 'blogs_categories.category_id = blogs.category_id', array('category' => 'category_title'), 'left');
    $select->where(array('blogs.blog_id ' => $blog_id));
    $rowset = $this->tableGateway->selectWith($select);
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find row {$blog_id}");
    }
    return $row;
  }

  public function fetch_archive_blogs() {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                'blog_id', 'category_id',
                'title' => "blog_title",
                'create_date' => 'written_date',
                'is_archive',
            )
    );
    $select->join('users', 'users.user_id = blogs.author_id', array('author' => 'username'), 'left');
    $select->join('blogs_categories', 'blogs_categories.category_id = blogs.category_id', array('category' => 'category_title'), 'left');

    $select->limit(10);
    $select->order('create_date DESC');
    return $this->tableGateway->selectWith($select);
  }

  public function fetch_slider_blogs() {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                'blog_id', 'category_id', 'author_id',
                'title' => "blog_title",
                'description' => "blog_short_desc",
                #'content' => "blog_content",
                'create_date' => 'written_date',
                'is_archive', 'is_publish', 'is_draft',
                'keywords' => new Expression(
                        "(SELECT GROUP_CONCAT(`tag_name`)
              FROM `blogs_tags`
              WHERE tag_id
              IN(
              SELECT tag_id FROM blogs_tags_relationship WHERE blog_id = blogs.blog_id
              )
              )"
                ),
                'images' => new Expression("(SELECT `image_url` FROM `blogs_images` WHERE `blogs_images`.`blog_id` = blogs.blog_id AND `image_type` = 'slider')")
            )
    );
    $select->join('users', 'users.user_id = blogs.author_id', array('author' => 'username'), 'left');
    $select->join('blogs_categories', 'blogs_categories.category_id = blogs.category_id', array('category' => 'category_title'), 'left');
    $select->limit(4);
    $select->order('blogs.blog_id DESC');
    $resultSet = $this->tableGateway->selectWith($select);
    return $resultSet;
  }

  public function getBlog($id) {
    $id = (int) $id;
    $rowset = $this->tableGateway->select(array('blog_id' => $id));
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find row $id");
    }
    return $row



    ;
  }

}

?>
