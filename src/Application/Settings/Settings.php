<?php

namespace App\Application\Settings;


class Settings implements SettingsInterface
{

    public function __construct(private array $data) {}

    /**
     * @param string $key
     * @return mixed
     * @throws NotFoundSettingException
     */
    public function get(string $key = '')
    {
        if (isset($this->resolvedEntries[$key]) || array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        throw new NotFoundSettingException("No se encuentra la llave '$key'");
    }
}
