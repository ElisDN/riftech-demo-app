<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\OAuth\Entity;

use App\Model\OAuth\Entity\AuthCodeEntity;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    public function getNewAuthCode(): AuthCodeEntityInterface
    {
        return new AuthCodeEntity();
    }

    /**
     * @param AuthCodeEntityInterface $authCodeEntity
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity): void
    {
        // TODO: Implement persistNewAuthCode() method.
    }

    public function revokeAuthCode($codeId): void
    {
        // TODO: Implement revokeAuthCode() method.
    }

    public function isAuthCodeRevoked($codeId): bool
    {
        // TODO: Implement isAuthCodeRevoked() method.
    }
}
