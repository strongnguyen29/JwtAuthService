<?php
namespace StrongNguyen\JwtAuthService;


class JwtAdminManager extends JwtAuthManager
{

    protected function getConfigSecretKey(): string
    {
        return 'admin_secret_key';
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->data->username ?? null;
    }

    /**
     * get Auth token
     *
     * @return null
     */
    public function createAdminToken($appCode = 'hl_cms', $userId = 1, $username = 'admin') {
        return $this->createToken([
            'app_code' => $appCode,
            'user_id' => $userId,
            'username' => $username
        ]);
    }
}