# Local By Flywheel PHPUnit setup

## First time setup on new site in Local.

* Start site, right click the site name and click Open Site SSH
* Navigate to the root of the WP install
  * ```cd app/public```
* Check if the wpcli has been installed
  * ```wp --info``` You should see Version and basic info, if not install wpcli - https://wp-cli.org/
* In Local right click the site name again and open in Finder, add the file setup-phpunit.sh in the app directory so it sits next to the public directory. File is located in this directory or can be found here - https://gist.github.com/BobbyLee-dev/1633b7e16dc4ae9a1bf1b92a8b181f40
* Open setup-phpunit.sh in a code editor and follow the steps.
* PHPUnit will now be installed, if the wp scaffold plugin-tests have already been installed - like they have on this plugin - Sapphire Popups in SSH navigate to the plugin directory and run phpunit
  * ```cd /app/public/wp-content/plugins/sapphire-popups```
  * ```phpunit``` - you should see some test results.

## If this is a new plugin and wp scaffold plugin-tests have not been added 

* In SSH navigate to wp root
  * ``` cd /app/public/```
* Run ```wp scaffold plugin-tests my-plugin```
* Navigate to the plugin root
  * ```cd /app/public/wp-content/plugins/sapphire-popups```
* Run ```bin/install-wp-tests.sh wordpress_test root ‘root’ localhost latest```
* Edit tests/bootstrap.php line 25
  * 
  ```
  function _manually_load_plugin() {
    require dirname( dirname( __FILE__ ) ) . '/sapphire-popups.php';
  }
  ```

## Local By Flywheel workflow

* Start site
* Clone repo to plugins directory
* Navigate to plugin directory
* Run ```phpunit```

### Additional Referances
* https://wp-cli.org/
* https://getflywheel.com/wordpress-support/managing-your-flywheel-sites-with-wp-cli/
* https://bdwm.be/setting-up-phpunit-for-plugin-development-on-local-by-flywheel/
* https://make.wordpress.org/cli/handbook/misc/plugin-unit-tests/
* https://www.smashingmagazine.com/2017/12/automated-testing-wordpress-plugins-phpunit/