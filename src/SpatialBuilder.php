<?php

declare(strict_types=1);

namespace MatanYadaev\EloquentSpatial;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\Geometry;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 *
 * @extends Builder<TModel>
 *
 * @mixin \Illuminate\Database\Query\Builder
 */
class SpatialBuilder extends Builder
{
  // public function withDistance(
  //   string $column,
  //   Geometry|string $geometryOrColumn,
  //   string $alias = 'distance'
  // ): self
  // {
  //   if (! $this->getQuery()->columns) {
  //     $this->select('*');
  //   }

  //   $this->selectRaw(
  //     sprintf(
  //       'STDistance(%s, %s) AS %s',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //       $alias,
  //     )
  //   );

  //   return $this;
  // }

  // public function whereDistance(
  //   string $column,
  //   Geometry|string $geometryOrColumn,
  //   string $operator,
  //   int|float $value
  // ): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STDistance(%s, %s) %s ?',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //       $operator,
  //     ),
  //     [$value],
  //   );

  //   return $this;
  // }

  // public function orderByDistance(
  //   string $column,
  //   Geometry|string $geometryOrColumn,
  //   string $direction = 'asc'
  // ): self
  // {
  //   $this->orderByRaw(
  //     sprintf(
  //       'STDistance(%s, %s) %s',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //       $direction,
  //     )
  //   );

  //   return $this;
  // }

  // public function withDistanceSphere(
  //   string $column,
  //   Geometry|string $geometryOrColumn,
  //   string $alias = 'distance'
  // ): self
  // {
  //   if (! $this->getQuery()->columns) {
  //     $this->select('*');
  //   }

  //   $this->selectRaw(
  //     sprintf(
  //       'STDistanceSphere(%s, %s) AS %s',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //       $alias,
  //     )
  //   );

  //   return $this;
  // }

  // public function whereDistanceSphere(
  //   string $column,
  //   Geometry|string $geometryOrColumn,
  //   string $operator,
  //   int|float $value
  // ): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'ST_DISTANCE_SPHERE(%s, %s) %s ?',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //       $operator,
  //     ),
  //     [$value],
  //   );

  //   return $this;
  // }

  // public function orderByDistanceSphere(
  //   string $column,
  //   Geometry|string $geometryOrColumn,
  //   string $direction = 'asc'
  // ): self
  // {
  //   $this->orderByRaw(
  //     sprintf(
  //       'ST_DISTANCE_SPHERE(%s, %s) %s',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //       $direction
  //     )
  //   );

  //   return $this;
  // }

  // public function whereWithin(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STWithin(%s, %s)',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  // public function whereNotWithin(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STWithin(%s, %s) = 0',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  public function whereContains(string $column, Geometry|string $geometryOrColumn): self
  {
    $this->whereRaw(
      sprintf(
        '(SELECT %s.STContains(%s)) = 1',
        $this->getQuery()->getGrammar()->wrap($column),
        $this->toExpression($geometryOrColumn),
      )
    );

    return $this;
  }

  // public function whereNotContains(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STContains(%s, %s) = 0',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  // public function whereTouches(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STContains(%s, %s)',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  // public function whereIntersects(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STIntersects(%s, %s)',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  // public function whereCrosses(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STCrosses(%s, %s)',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  // public function whereDisjoint(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STDisjoint(%s, %s)',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  // public function whereOverlaps(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STOverlaps(%s, %s)',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  // public function whereEquals(string $column, Geometry|string $geometryOrColumn): self
  // {
  //   $this->whereRaw(
  //     sprintf(
  //       'STEquals(%s, %s)',
  //       $this->getQuery()->getGrammar()->wrap($column),
  //       $this->toExpression($geometryOrColumn),
  //     )
  //   );

  //   return $this;
  // }

  public function whereSrid(
    string $column,
    string $operator,
    int|float $value
  ): self
  {
    $this->whereRaw(
      sprintf(
        'STSrid(%s) %s ?',
        $this->getQuery()->getGrammar()->wrap($column),
        $operator,
      ),
      [$value],
    );

    return $this;
  }

  protected function toExpression(Geometry|string $geometryOrColumn): Expression
  {
    if ($geometryOrColumn instanceof Geometry) {
      $wkt = $geometryOrColumn->toWkt();

      return DB::raw("geography::STGeomFromText('{$wkt}', {$geometryOrColumn->srid})");
    }

    return DB::raw($this->getQuery()->getGrammar()->wrap($geometryOrColumn));
  }
}
