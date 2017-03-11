<?php

class Post
{
	public $id;
	public $author;
	public $content;

	public function __construct($id, $author, $content)
	{
		$this->id = $id;
		$this->author = $author;
		$this->content = $content;
	}

	public static function all()
	{
		$list = [];
		$db = Db::getInstance();
		$req = $db->query('SELECT * FROM posts');

		foreach ($req->fetchAll() as $post) {
			$list[] = new Post($post['id'], $post['author'], $post['content']);
		}

		return $list;
	}

	public static function find($id)
	{
		$db = Db::getInstance();
		$id = intval($id);
		$req = $db->prepare('SELECT * FROM posts WHERE id = :id');
		$req->execute(['id' => $id]);
		$post = $req->fetch();

		return new Post($post['id'], $post['author'], $post['content']);
	}
}

?>