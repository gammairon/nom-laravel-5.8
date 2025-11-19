<?php
/**
 * User: Gamma-iron
 * Date: 29.03.2019
 */

namespace App\UseCases\Admin\User;


use App\Entity\User\User;
use App\Http\Requests\Admin\User\UserRequest;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserService extends Service
{

    public function create(UserRequest $request): ?User
    {
        $user = new User($request->except(['role', 'primary_media', 'password']));

        return $this->save($user, $request);
    }


    public function update(UserRequest $request, User $user): ?User
    {
        $user->fill($request->except(['role', 'primary_media', 'password']));

        return $this->save($user, $request);
    }

    protected function save(User $user, UserRequest $request): ?User
    {
        if($request->password){
            $user->password =  Hash::make($request->password);
        }

        return $this->transaction(function () use ($user, $request){

            $user->save();

            if( !$user->hasRole( (intval( $request->input('role') ) ) ) ){
                $this->addRoleToUser($user, $request->input('role'));
            }

            $this->updatePrimaryPhoto($user, $request->all());

            $user->updateSeo($request->all());

            return $user;
        });
    }

    public function addRoleToUser(User $user, $role): User
    {
        if (is_numeric($role)) {
            $role = Role::findById($role);
        }

        if(!$role instanceof Role)
            throw new \InvalidArgumentException('$role most be correct int role ID or instance Role');

        $user->syncRoles($role);

        return $user;
    }

}
