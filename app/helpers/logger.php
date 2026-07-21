<?php

class Logger {
    private static string $logFile = __DIR__ . '/../../logs/user_actions.log';

    public static function log(string $action): void {
        // Podaci koje beležimo
        $timestamp = date('Y-m-d H:i:s');
        $username  = $_SESSION['username'] ?? 'Gost/Anoniman';
        $role      = $_SESSION['role'] ?? 'N/A';
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

        // Format linije u log fajlu
        $message = sprintf(
            "[%s] [IP: %s] [Korisnik: %s | Uloga: %s] - Akcija: %s" . PHP_EOL,
            $timestamp,
            $ipAddress,
            $username,
            $role,
            $action
        );

        // Uverimo se da folder logs postoji
        $dir = dirname(self::$logFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Upisujemo poruku na kraj fajla (FILE_APPEND)
        file_put_contents(self::$logFile, $message, FILE_APPEND | LOCK_EX);
    }
}