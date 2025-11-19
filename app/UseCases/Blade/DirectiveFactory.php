<?php
/**
 * User: Gamma-iron
 * Date: 26.05.2019
 */

namespace App\UseCases\Blade;


use Illuminate\Support\Facades\Blade;

class DirectiveFactory
{
    protected $directives = [
        'money',
        'percent',
        'intNumber',
    ];


    public function __construct(array $config = [])
    {
    }

    public function register()
    {

        foreach ($this->directives as $directive) {
            Blade::directive($directive, [$this, $directive]);
        }

    }

    public function money($amount, $decimals = 0)
    {
        return "<?php echo number_format($amount, $decimals, ',', ' ').' грн.'; ?>";

    }

    public function percent($value, $decimals = 2)
    {
        return "<?php echo number_format($value, $decimals, ',', ' ').'%'; ?>";
    }

    public function intNumber($value)
    {
        return "<?php echo number_format($value, 0, ',', ' '); ?>";
    }
}