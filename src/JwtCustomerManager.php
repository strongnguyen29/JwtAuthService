<?php
namespace StrongNguyen\JwtAuthService;


class JwtCustomerManager extends JwtAuthManager
{

    protected function getConfigSecretKey(): string
    {
        return 'customer_secret_key';
    }

    /**
     * @return string|null
     */
    public function getGroupCode(): ?string
    {
        return $this->data->company_group_code ?? null;
    }

    /**
     * @return string|null
     */
    public function getCompanyCode(): ?string
    {
        return $this->data->company_code ?? null;
    }

    /**
     * @return int
     */
    public function getUserCoefficient(): int
    {
        return $this->data->user_coefficient ?? 100;
    }

    /**
     * get Auth token
     *
     * @return null
     */
    public function createCustomerToken($appCode, $groupCode, $customerCode, $userId = 1, $hs = 100) {
        return $this->createToken([
            'app_code' => $appCode,
            'company_group_code' => $groupCode,
            'company_code' => $customerCode,
            'user_id' => $userId,
            'user_coefficient' => $hs
        ]);
    }
}