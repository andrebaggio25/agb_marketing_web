<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class LeadNoteModel
{
    /** @return array<int, array<string,mixed>> */
    public static function forLead(int $leadId): array
    {
        $stmt = Database::pdo()->prepare(
            'SELECT n.*, u.name AS user_name FROM lead_notes n
             LEFT JOIN users u ON u.id = n.user_id
             WHERE n.lead_id = ? ORDER BY n.created_at ASC'
        );
        $stmt->execute([$leadId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(int $leadId, ?int $userId, string $body): void
    {
        $stmt = Database::pdo()->prepare('INSERT INTO lead_notes (lead_id, user_id, body) VALUES (?,?,?)');
        $stmt->execute([$leadId, $userId, $body]);
    }
}
