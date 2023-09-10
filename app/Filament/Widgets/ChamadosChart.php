<?php

namespace App\Filament\Widgets;

use App\Models\Chamado;
use Carbon\Carbon;
use Exception;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Collection;

class ChamadosChart extends ChartWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 2,
    ];

    public static function canView(): bool
    {
        return true;
    }

    protected static ?string $maxHeight = '300px';

    protected static ?string $heading = 'Chamados abertos vs. fechados';

    protected static string $color = 'info';

    public ?string $filter = 'week';

    protected static ?string $pollingInterval = '10s';


    public function getDescription(): ?string
    {
        return 'O número de chamados abertos e fechados no período';
    }

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getFilters(): ?array
    {
        return [
            'today'      => 'Hoje',
            'week'       => 'Semana atual',
            'last_week'  => 'Última semana',
            'month'      => 'Mês atual',
            'last_month' => 'Último mês',
            'year'       => 'Ano atual',
            'last_year'  => 'Último ano',
        ];
    }

    protected function getData(): array
    {
        list($datasets, $labels) = $this->getCollectionDataByFilter($this->filter);

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getCollectionDataByFilter(string $filter): array
    {
        $data = [];

        list($trend, $trendFilter, $labels) = match ($filter) {
            'today'      => $this->getTrendLabelsDay(),
            'week'       => $this->getTrendLabelsWeek(),
            'last_week'  => $this->getTrendLabelsWeek(true),
            'month'      => $this->getTrendLabelsMonth(),
            'last_month' => $this->getTrendLabelsMonth(true),
            'year'       => $this->getTrendLabelsYear(),
            'last_year'  => $this->getTrendLabelsYear(true),
            default => throw new Exception("Erro de configuração nos filtros do gráfico!", 1),
        };
        
        $data[] = [
            'data' => $trend->map(fn (TrendValue $value) => $value->aggregate),
            'label' => 'Abertos',
            'backgroundColor' => '#1D4ED8',
            'borderColor' => '#1D4ED8',
        ];

        $data[] = [
            'data' => $trendFilter->map(fn (TrendValue $value) => $value->aggregate),
            'label' => 'Encerrados',
            'backgroundColor' => 'green',
            'borderColor' => 'green',
        ];

        return [$data, $labels];
    }

    private function getTrendLabelsDay(): array
    {
        $trend = Trend::model(Chamado::class)
        ->between(now()->startOfDay(), now()->endOfDay())
        ->perHour()
        ->count();

        $trendFilter = Trend::query(Chamado::where('created_by', '=', 'gustavoql'))
            ->between(now()->startOfDay(), now()->endOfDay())
            ->perHour()
            ->count();

        $labels = $trend->map(fn (TrendValue $value) => Carbon::createFromDate($value->date)->format('H:i'));

        return [$trend, $trendFilter, $labels];
    }

    private function getTrendLabelsWeek(bool $sub = false): array
    {
        if (!$sub) {
            $trend = Trend::model(Chamado::class)
                ->between(now()->startOfWeek(), now()->endOfWeek())
                ->perDay()
                ->count();

            $trendFilter = Trend::query(Chamado::where('created_by', '=', 'gustavoql'))
                ->between(now()->startOfWeek(), now()->endOfWeek())
                ->perDay()
                ->count();

            $labels = $trend->map(fn (TrendValue $value) => Carbon::createFromDate($value->date)->translatedFormat('d/m (l)'));
        } else {
            $trend = Trend::model(Chamado::class)
                ->between(now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek())
                ->perDay()
                ->count();
    
            $trendFilter = Trend::query(Chamado::where('created_by', '=', 'gustavoql'))
                ->between(now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek())
                ->perDay()
                ->count();
    
            $labels = $trend->map(fn (TrendValue $value) => Carbon::createFromDate($value->date)->translatedFormat('d/m (l)'));
        }

        return [$trend, $trendFilter, $labels];
    }

    private function getTrendLabelsMonth(bool $sub = false): array
    {
        if (!$sub) {
            $trend = Trend::model(Chamado::class)
                ->between(now()->startOfMonth(), now()->endOfMonth())
                ->perDay()
                ->count();

            $trendFilter = Trend::query(Chamado::where('created_by', '=', 'gustavoql'))
                ->between(now()->startOfMonth(), now()->endOfMonth())
                ->perDay()
                ->count();

            $labels = $trend->map(fn (TrendValue $value) => Carbon::createFromDate($value->date)->format('d/m'));
        } else {
            $trend = Trend::model(Chamado::class)
                ->between(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth())
                ->perDay()
                ->count();

            $trendFilter = Trend::query(Chamado::where('created_by', '=', 'gustavoql'))
                ->between(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth())
                ->perDay()
                ->count();

            $labels = $trend->map(fn (TrendValue $value) => Carbon::createFromDate($value->date)->translatedFormat('d/m'));
        }

        return [$trend, $trendFilter, $labels];
    }

    private function getTrendLabelsYear(bool $sub = false): array
    {
        if (!$sub) {
            $trend = Trend::model(Chamado::class)
                ->between(now()->startOfYear(), now()->endOfYear())
                ->perMonth()
                ->count();

            $trendFilter = Trend::query(Chamado::where('created_by', '=', 'gustavoql'))
                ->between(now()->subMonth()->startOfYear(), now()->subMonth()->endOfYear())
                ->perMonth()
                ->count();

            $labels = $trend->map(fn (TrendValue $value) => ucfirst(Carbon::createFromDate($value->date)->translatedFormat('M/y')));
        } else {
            $trend = Trend::model(Chamado::class)
                ->between(now()->subYear()->startOfYear(), now()->subYear()->endOfYear())
                ->perMonth()
                ->count();

            $trendFilter = Trend::query(Chamado::where('created_by', '=', 'gustavoql'))
                ->between(now()->subYear()->startOfYear(), now()->subYear()->endOfYear())
                ->perMonth()
                ->count();

            $labels = $trend->map(fn (TrendValue $value) => ucfirst(Carbon::createFromDate($value->date)->translatedFormat('M/y')));
        }

        return [$trend, $trendFilter, $labels];
    }


    protected function getType(): string
    {
        return 'line';
    }
}
