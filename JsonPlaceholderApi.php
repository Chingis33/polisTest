<?php

class JsonPlaceholderApi
{
    private string $baseApiURL = "https://jsonplaceholder.typicode.com/";

    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return array
     * @throws Exception
     */
    private function Request($url, $method = "GET", $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_FAILONERROR,true);
        if ($method === "POST") {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($method === "PUT") {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($method === "DELETE") {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        }
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $errorMessage = curl_error($curl);
        }

        curl_close($curl);

        if (isset($errorMessage)) {
            throw new Exception("Error!");
        }

        return json_decode($response, true);
    }

    /**
     * @param int $userId
     * @param string $title
     * @param string $body
     * @return array
     * @throws Exception
     */
    public function addPost(string $title, string $body, int $userId): array
    {
        $data = [
            "title" => $title,
            "body" => $body,
            "userId" => $userId,
        ];

        return $this->Request($this->baseApiURL . "posts", "POST", json_encode($data));
    }

    /**
     * @param int $postId
     * @param string $title
     * @param string $body
     * @return array
     * @throws Exception
     */
    public function editPost(string $title, string $body, int $postId): array
    {
        $data = [
            "title" => $title,
            "body" => $body
        ];

        return $this->Request($this->baseApiURL . "posts/" . $postId, "PUT", json_encode($data));
    }

    /**
     * @param int $postId
     * @return array
     * @throws Exception
     */
    public function deletePost(int $postId): array
    {
        return $this->Request($this->baseApiURL . "posts/" . $postId, "DELETE");
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getUsers(): array
    {
        return $this->Request($this->baseApiURL . "users");
    }

    /**
     * @param int $userId
     * @return array
     * @throws Exception
     */
    public function getUserPosts($userId): array
    {
        return $this->Request($this->baseApiURL . "posts?userId=" . $userId);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getTasks(): array
    {
        return $this->Request($this->baseApiURL . "todos");
    }

}
