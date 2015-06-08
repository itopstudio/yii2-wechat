<?php
namespace callmez\wechat\controllers;

use Yii;
use callmez\wechat\components\AdminController;

class MenuController extends AdminController
{
    public function actionIndex()
    {
            $sdk = $this->getWechat()->getSdk();
        // 创建菜单
        if ($menus = Yii::$app->getRequest()->getBodyParam('menus')) {
            if (!$sdk->createMenu($menus)) {
                return $this->message('自定义菜单更新失败! ' . $sdk->getLastErrorMessage());
            }
            return $this->message('自定义菜单更新成功', 'success');
        }
        if (!($menus = $sdk->getMenu())) {
            return $this->message('获取菜单列表失败! ' . $sdk->getLastErrorMessage());
        }
        return $this->render('index', [
            'wechat' => $this->getWechat(),
            'menus' => $menus
        ]);
    }
}