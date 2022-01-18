<?php
namespace StrongNguyen\JwtAuthService;


use Firebase\JWT\JWT;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

abstract class JwtAuthManager
{
    /**
     * Auth token
     *
     * @var null|string
     */
    protected ?string $token = null;

    /**
     * Token data
     *
     * @var object|null
     */
    protected ?object $data = null;

    /**
     * CustomerManager constructor.
     */
    public function __construct()
    {
        $this->token = request()->bearerToken();

        if ($this->token && $this->getSecretKey()) {
            Log::debug(self::class . '@handle: BEFORE token decode', ['$token' => $this->token]);
            try {
                $this->data = JWT::decode($this->token, $this->getSecretKey(), array('HS256'));
                Log::debug(self::class . '@handle: token decode SUCCESS', [$this->data]);
            } catch (\Throwable $e) {
                Log::debug(self::class . '@handle: token decode ERROR: ' . $e->getMessage());
            }
        }
    }

    /**
     * @return string
     */
    abstract protected function getConfigSecretKey() : string;

    /**
     * @return string
     */
    protected function getSecretKey() : string {
        $key = config("jwt-auth-service.{$this->getConfigSecretKey()}");
        if (!$key) abort(500, 'Chưa cấu hình ' . $this->getConfigSecretKey());
        return $key;
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->data && $this->data->app_code;
    }

    /**
     * @return string
     */
    public function getFrom(): ?string
    {
        return $this->data->from ?? null;
    }

    /**
     * @return string
     */
    public function getAppCode(): ?string
    {
        return $this->data->app_code ?? null;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->data->user_id ?? null;
    }

    /**
     * @return object|null
     */
    public function getData(): ?object
    {
        return $this->data;
    }

    /**
     * get Auth token
     *
     * @return null
     */
    protected function createToken(array $payload) {
        $now = Carbon::now();
        $data = array_merge(
            [
                'jti' => Str::uuid(),
                'iss' => url(''),
                'iat' => $now->getTimestamp(),
                'exp' => $now->addYears(2)->getTimestamp(),
                'from' => url(''),
            ],
            $payload
        );
        return JWT::encode($data, $this->getSecretKey());
    }
}