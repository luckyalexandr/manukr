<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 07.08.18
 * Time: 12:14
 */

namespace shop\services\manage;


use shop\entities\User\User;
use shop\forms\manage\User\UserCreateForm;
use shop\forms\manage\User\UserEditForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;
use shop\services\TransactionManager;

class UserManageService
{
    private $repository;
    private $roles;
    private $transaction;

    public function __construct(
        UserRepository $repository,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    /**
     * @param UserCreateForm $form
     * @return User
     * @throws \yii\base\Exception
     */
    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    /**
     * @param $id
     * @param $role
     * @throws \Exception
     */
    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }

    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }
}