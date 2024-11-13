<?php

namespace Tests\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\Depends;
use Tests\AbstractTestCase;
use Gotify\Endpoint\User;
use Gotify\Endpoint\AbstractEndpoint;
use Gotify\Auth\User as Auth;

#[CoversClass(User::class)]
#[UsesClass(AbstractEndpoint::class)]
#[UsesClass(\Gotify\Guzzle::class)]
#[UsesClass(\Gotify\Json::class)]
#[UsesClass(\Gotify\Server::class)]
#[UsesClass(\Gotify\Auth\User::class)]
#[UsesClass(\Gotify\Auth\AbstractAuth::class)]
class UserTest extends AbstractTestCase
{
    private static User $user;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$user = new User(
            self::$server,
            self::$auth
        );

        self::removeTestUsers();
    }

    public static function tearDownAfterClass(): void
    {
        self::removeTestUsers();
    }

    /**
     * Test getting the current user
     */
    public function testGetCurrent(): void
    {
        $current = self::$user->getCurrent();

        $this->assertObjectHasProperty('id', $current);
        $this->assertObjectHasProperty('name', $current);
        $this->assertObjectHasProperty('admin', $current);

        $this->assertEquals('admin', $current->name);
    }

    /**
     * Test getting a user
     */
    public function testGetUser(): void
    {
        $user = self::$user->getUser(self::$user->getCurrent()->id);

        $this->assertEquals('admin', $user->name);
    }

    /**
     * Test getting all users
     */
    public function testGetAll(): void
    {
        $users = self::$user->getAll();

        $this->assertObjectHasProperty('users', $users);

        if (count($users->users) > 0) {
            $this->assertIsObject($users->users[0]);
        }
    }

    /**
     * Test creating a user
     */
    public function testCreate(): void
    {
        $name = 'createMe';

        $created = self::$user->create(
            $name,
            'qwerty',
            false // Admin status
        );

        $this->assertEquals($name, $created->name);
        $this->assertFalse($created->admin);
    }

    /**
     * Test updating password for the current user
     */
    public function testUpdatePassword(): void
    {
        self::$user->create('updateMePassword', 'qwerty');

        // Login as test user
        $auth = new Auth('updateMePassword', 'qwerty');
        $user = new User(
            self::$server,
            $auth
        );

        $updated = $user->updatePassword('NewPassword');

        $this->assertTrue($updated);
    }

    /**
     * Test updating a user
     */
    #[Depends('testCreate')]
    public function testUpdate(): void
    {
        $newTestUsername = 'test1';
        $created =  self::$user->create('updateMe', 'qwerty');
        $updated = self::$user->update(
            $created->id,
            $newTestUsername
        );

        $this->assertObjectHasProperty('name', $updated);
        $this->assertObjectHasProperty('id', $updated);
        $this->assertEquals($created->id, $updated->id);
        $this->assertEquals($newTestUsername, $updated->name);
    }

    /**
     * Test deleting a user
     */
    public function testDelete(): void
    {
        $created = self::$user->create('deleteMe', 'qwerty');
        $deleted = self::$user->delete($created->id);

        $this->assertTrue($deleted);
    }

    private static function removeTestUsers(): void
    {
        $users = self::$user->getAll();

        foreach ($users->users as $user) {
            if ($user->admin === false) {
                self::$user->delete($user->id);
            }
        }
    }
}
