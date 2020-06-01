<?hh
/**
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace Facebook\ShipIt;

use namespace HH\Lib\Dict;

final abstract class ShipItEnv {
  private static dict<string, string> $extraEnv = dict[];

  public static function addEnv(string $key, string $value): void {
    self::$extraEnv[$key] = $value;
  }

  public static function getEnv(): dict<string, string> {
    /* HH_FIXME[2050] undefined $_ENV */
    if ($_ENV is nonnull) {
      return Dict\merge($_ENV, self::$extraEnv);
    }
    return self::$extraEnv;
  }

  public static function getEnvVar(string $name): ?string {
    return idx(self::getEnv(), $name);
  }
}
