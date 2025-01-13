import requests
from bs4 import BeautifulSoup
import json

def get_lottery_data():
    url = 'https://statelottery.kerala.gov.in/index.php/lottery-result-view'
    response = requests.get(url)
    soup = BeautifulSoup(response.content, 'html.parser')

    lotteries = []
    rows = soup.find_all('div', class_='panel-body')[1].find_all('a', class_='btn btn-info btn-xs')

    for row in rows[:10]:
        lottery_name = row.text.strip()
        pdf_link = row['href']
        lotteries.append({'name': lottery_name, 'pdf_link': pdf_link})

    with open('lottery_types.json', 'w') as f:
        json.dump(lotteries, f)

get_lottery_data()
