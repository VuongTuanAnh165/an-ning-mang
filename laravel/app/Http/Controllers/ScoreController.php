<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = 10;
        $page = (int) $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        $search = $request->input('search', null);

        // ---------------------------
        // ✅ CÁCH ĐÚNG (Eloquent/Query Builder - an toàn)
        // ---------------------------
        $querySafe = Score::select('scores.*', 'users.name as name')
            ->join('users', 'users.id', '=', 'scores.user_id')
            ->where('users.id', $user->id);

        if ($search) {
            $querySafe->where('scores.subject', 'like', "%{$search}%");
        }

        $scoresSafe = $querySafe
            ->orderBy('scores.id', 'desc')
            ->paginate($perPage)
            ->appends($request->only('search'));

        // ---------------------------
        // ❌ CÁCH SAI (raw SQL dễ bị SQL Injection) — DEMO
        // ---------------------------
        // Lưu ý: phần này dùng raw SQL, nối chuỗi trực tiếp
        // bình thường vẫn lọc user_id, nhưng payload kiểu [' OR '1'='1] sẽ phá query
        if ($search) {
            $where = "WHERE u.id = {$user->id} AND s.subject = '{$search}'";
        } else {
            $where = "WHERE u.id = {$user->id}";
        }

        // tính tổng bản ghi cho paginator
        $countSql = "SELECT COUNT(*) as total
                     FROM scores s
                     JOIN users u ON s.user_id = u.id
                     {$where}";

        $countResult = DB::select($countSql);
        $total = isset($countResult[0]->total) ? (int) $countResult[0]->total : 0;

        // lấy dữ liệu
        $sql = "SELECT s.*, u.name as name
                FROM scores s
                JOIN users u ON s.user_id = u.id
                {$where}
                ORDER BY s.id DESC
                LIMIT {$perPage} OFFSET {$offset}";

        $rawRows = collect(DB::select($sql));

        $scoresUnsafe = new LengthAwarePaginator(
            $rawRows,
            $total,
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->only('search'),
            ]
        );

        // === Chọn case chạy ===
        $scores = $scoresSafe;      // ✅ an toàn
        // $scores = $scoresUnsafe;     // ❌ dễ bị SQL Injection (demo)

        return view('scores.index', compact('scores'));
    }
}
