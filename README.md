# Laravel 8 Billboards Slider/ Map with Google Maps API and Adminpanel

Transformed [free WordPress theme Directory Starter](https://wpgeodirectory.com/downloads/directory-starter/) into fully manageable Laravel 8 project with adminpanel generated with [QuickAdminPanel](https://quickadminpanel.com), 
to manage all the Locations or your shops.
Author Mian Salman, SK Developers. Gomal Themes.
## Features

- __Adminpanel__ with administrator user managing locations and categories, with choice for slider / maps plesae include maps from partials in resources/views/prartial/map.blade file in views folder if you need maps.
- __Registration__ for billboard owners who can manage their own location - with __multi-tenancy__ included
- Adminpanel uses Google Places API with autocomplete to __automatically get coordinates from address__
- Adminpanel uses [Spatie Opening Hours package](https://github.com/spatie/opening-hours) to manage working hours
- Front-end uses Google Maps API to __view the map of locations__


- - - - -

## Screenshots 

![Laravel Shops Google Maps](https://laraveldaily.com/wp-content/uploads/2019/12/Screen-Shot-2019-12-11-at-10.58.07-AM.png)

- - - - -

![Laravel Shops Google Maps Autocomplete Address](https://laraveldaily.com/wp-content/uploads/2019/12/Screen-Shot-2019-12-11-at-11.00.12-AM.png)

- - - - -

## How to use

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- In your __.env__ file add your Google Maps API key: `GOOGLE_MAPS_API_KEY=AIzaSyBi2dVBkdQSUcV8_xxxxxxxxxxxx`
- That's it: launch the main URL. 
- You can login to adminpanel by going go `/login` URL and login with credentials __admin@skdevelopers.info__ - __password__
- Click __Register__ on top right to add new shop / location owner and their shops / billboards


- - - - -

## Helpful articles

- [Laravel: Find Addresses with Coordinates via Google Maps API](https://laraveldaily.com/laravel-find-addresses-with-coordinates-via-google-maps-api/)


- - - - -

## License

Basically, feel free to use and re-use any way you want.and if you need expert software development for your project contact us Gomal Themes, Regent Mall office 67. Faisalabad.

- - - - -

## More from our Laravel Team

- Check out our Portfolio [Portfolio](https://www.rashidev.com/#portfolio)
