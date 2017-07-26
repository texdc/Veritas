set -x
if [ "$TRAVIS_PHP_VERSION" = 'hhvm' ] || [ "$TRAVIS_PHP_VERSION" = 'hhvm-nightly' ] ; then
    echo "skipping coverage submission for HHVM builds"
else
  php vendor/bin/coveralls
fi
