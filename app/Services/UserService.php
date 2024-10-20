<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\UserHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Create a new book
     * 
     * @param Request $request
     * @return string Access URL
     */
    public function create(Request $request): string
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'access_url' => $this->generateRandomString(),
            'access_url_created_at' => now(),
            'access_url_status' => 'active'
        ]);

        return $user->access_url;
    }

    /**
    * Regenerate access URL
    * 
    * @param string $url
    * @return User
    */
    public function regenerateUrl(string $url): User
    {
        $user = User::where('access_url', $url)->first();

        if (! $user) {
            throw new \Exception('User not found', 404);
        }

        $user->access_url = $this->generateRandomString();
        $user->access_url_created_at = now();
        $user->access_url_status = 'active';
        $user->save();

        return $user;
    }

    /**
     * Deactivate access URL
     * 
     * @param string $url
     * @return User
     */
    public function deactivateUrl(string $url): User
    {
        $user = User::where('access_url', $url)->first();

        if (! $user) {
            throw new \Exception('User not found', 404);
        }

        $user->access_url_status = 'inactive';
        $user->save();

        return $user;
    }

    /**
     * Check access URL
     * 
     * @param string $url
     * @return bool|string
     */
    public function checkUrl(string $url)
    {
        $user = User::where('access_url', $url)->first();

        if (! $user) {
            throw new \Exception('User not found', 404);
        }

        $created = Carbon::parse($user->access_url_created_at);
        if ($user->access_url_status === 'inactive' || $created->diffInDays(now()) > 7) {
            throw new \Exception('Access URL is inactive', 403);
        }

        return true;
    }

    /**
     * Get history of user
     * 
     * @param string $url
     * @return array User history
     */
    public function history(string $url): array
    {
        $user = User::where('access_url', $url)->first();

        if (! $user) {
            throw new \Exception('User not found', 404);
        }

        return $user->history()
            ->select('value', 'result', 'sum')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->toArray();
    }

    /**
     * imfeelinglucky
     * 
     * @param string $url
     * @return UserHistory 
     */
    public function imfeelinglucky(string $url): UserHistory
    {
        $user = User::where('access_url', $url)->first();

        if (! $user) {
            throw new \Exception('User not found', 404);
        }

        $created = Carbon::parse($user->access_url_created_at);
        if ($user->access_url_status === 'inactive' || $created->diffInDays(now()) > 7) {
            throw new \Exception('Access URL is inactive', 400);
        }

        $newHistory = [];
        $newHistory['value']  = random_int(1, 1000);
        $newHistory['result'] = ($newHistory['value'] % 2 === 0) ? 'win' : 'lose';
        $newHistory['sum']    = ($newHistory['result'] === 'lose')
            ? 0 
            : $this->calculateWinAmount($newHistory['value']);
        
        return $user->history()->create($newHistory);
    }

    /**
    * Generate random link
    * 
    * @param int length
    * @return string
    */
    protected function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    /**
     * Generate a random number 1-1000
     * 
     * @return int
     */
    protected function calculateWinAmount(int $randomNumber): int
    {
        $result = 0;

        if ($randomNumber > 900) {
            $result = $randomNumber * 0.70; // 70% от числа
        } elseif ($randomNumber > 600) {
            $result = $randomNumber * 0.50; // 50% от числа
        } elseif ($randomNumber > 300) {
            $result = $randomNumber * 0.30; // 30% от числа
        } else {
            $result = $randomNumber * 0.10; // 10% от числа
        }

        return (int) $result;
    }
}
