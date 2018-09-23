<?php

declare(strict_types=1);

namespace Test\Feature;

use App\Model\OAuth\Entity\AccessTokenEntity;
use App\Model\OAuth\Entity\ClientEntity;
use App\Model\OAuth\Entity\ScopeEntity;
use App\Model\User\Entity\User\ConfirmToken;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use League\OAuth2\Server\CryptKey;
use Test\Builder\User\UserBuilder;

class AuthFixture extends AbstractFixture
{
    private $user;
    private $token;

    public function load(ObjectManager $manager): void
    {
        $user = (new UserBuilder())
            ->withDate($now = new \DateTimeImmutable())
            ->withEmail(new Email('test@example.com'))
            ->withConfirmToken(new ConfirmToken($token = 'token', $now->modify('+1 day')))
            ->build();

        $user->confirmSignup($token, new \DateTimeImmutable());

        $manager->persist($user);

        $this->user = $user;

        $token = new AccessTokenEntity();
        $token->setIdentifier(bin2hex(random_bytes(40)));
        $token->setUserIdentifier($user->getId()->getId());
        $token->setExpiryDateTime(new \DateTime('+1 hour'));
        $token->setClient(new ClientEntity('app'));
        $token->addScope(new ScopeEntity('common'));

        $manager->persist($token);

        $manager->flush();

        $this->token = (string)$token->convertToJWT($this->getCryptKey());
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
        ];
    }

    private function getCryptKey(): CryptKey
    {
        return new CryptKey(\dirname(__DIR__, 2) . '/' . getenv('OAUTH_PRIVATE_KEY_PATH'), null, false);
    }
}
