## About The Project

**1) Creating a REST Web API**

- To show albums and photos which can be retrieve the filtered data by user.

- Audit: Through a pattern of type "Filter" proceed with the implementation of an Audit Log that saves on a database (MySQL) all calls received to the API saving the information useful to reconstruct the call received (endpoint, method, status, response time, caller ip, payload, header, timestamp)

- Log: Created a log on file with daily rolling and by size (max 10mb) of calls and responses provided by the APIs

  
  

**2) Api design**

- Swagger: Configure and document the APIs produced with a standard based suite (https://swagger.io/).

  
  

**Calls, combines, and returns the result of the following mock services:**

- http://jsonplaceholder.typicode.com/photos

- http://jsonplaceholder.typicode.com/albums

## Build with

-  [Lumen](https://lumen.laravel.com)

  

## Getting Started

**PHP version 7.4**

  

**Docker version 20.10.7**

  

**For cloning project**

```git clone https://github.com/NicatNagizade/album-backend.git```

  

**Getting to inside of the project and copy .env.example file to .env**

```

cd album-backend \

&& cp .env.example .env

```

**Starting the project**

```docker-compose up -d```

Server will run on [http://localhost:8000]()



**Testing**

```docker-compose exec web ./vendor/bin/phpunit```

  

**Migrate tables to MySQL database**

You should wait until database configurations are ready

```docker-compose run web php artisan migrate```

  

## Contact

Nijat Naghizada - [nicatnagizada53@gmail.com]()

Project Link: [https://github.com/NicatNagizade/album-backend]()

  

## License

Distributed under the MIT License. See `LICENSE` for more information.