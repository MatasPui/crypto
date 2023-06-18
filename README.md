# CoinMarketCap API Data Manipulation

This project focuses on manipulating data from the CoinMarketCap API. It includes commands for setting up a cronjob to fetch data daily, which helps in reducing the number of requests made to the API. However, it's important to note that this solution was primarily developed for experimentation and entertainment purposes. It may not be suitable for real-world scenarios.

## Features

- Fetches data from the CoinMarketCap API using cronjob commands and stores it into database
- Testing can be performed using the php artisan schedule:run command
- Search field
- Popup info page

## Installation

1. git clone https://github.com/MatasPui/crypto.git
2. enter cloned repository folder
3. Install the project dependencies using Composer. - composer install
4. Configure the required environment variables by renaming the .env.example file to .env and updating the necessary values.
5. Run database migrations. - php artisan migrate
6. Set up the cronjob to fetch data daily. Edit your crontab using the command crontab -e and add the following line: * * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1

## Usage

Once the project is installed and the cronjob is set up, the data will be fetched automatically according to the specified schedule. To view the fetched data, navigate to the details page of a particular cryptocurrency.

## Contributing

Contributions are welcome! If you find any bugs or have suggestions for improvements, please open an issue or submit a pull request.

## Contact

If you have any questions or inquiries, please contact me: mataspuidokas@gmail.com