<?php

namespace app\services;

use yii\base\Model;

class CacheService
{
    public function get(string $key): ?string
    {
        return \Yii::$app->redis->get($key);
    }

    public function hGet(string $key, int $id, ?string $class = null)
    {
        $data = \Yii::$app->redis->hget($key, $id);
        if ($data) {
            $arguments = [$data];
            if ($class) {
                $arguments[] = $class;
            }
            return unserialize(...$arguments);
        }
        return null;
    }

    public function hGetAll(string $key, ?string $class = null): array
    {
        $data = \Yii::$app->redis->hgetall($key);

        $items = [];
        foreach ($data as $k => $item) {
            if ($k % 2 !== 0) {
                $arguments = [$item];
                if ($class) {
                    $arguments[] = [$class];
                }
                $items[] = unserialize(...$arguments);
            }
        }

        return $items;
    }

    public function hSet(string $key, int $id, Model $data): void
    {
        $serialized = serialize($data);
        \Yii::$app->redis->hset($key, $id, $serialized);
    }
}
