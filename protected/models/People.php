<?php

class People extends uc_members
{
     /**
     * 根据主键获得people
     * @param int $lecture_id 讲座id
     * @throws CHttpException
     * @return null
     */
    public function loadPeople($book_id)
    {
        $model = $this->findByPk($book_id);
        if(empty($model))
        {
            // 该文章已删除或不存在
            throw new CHttpException(404,'呃，你访问的页面不存在.');
        }
        return $model;
    }
}
