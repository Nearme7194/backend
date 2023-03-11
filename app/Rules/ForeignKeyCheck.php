<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ForeignKeyCheck implements Rule
{
    protected $table;
    protected $column;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $column
     */
    public function __construct(string $table, string $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = DB::select(DB::raw("SELECT COUNT(*) as count FROM $this->table WHERE $this->column = $value"));

        return $result[0]->count > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute value does not exist in the $this->table table.";
    }
}
