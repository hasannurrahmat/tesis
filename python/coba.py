# from urllib.request import urlopen
# html = urlopen("https://inet.detik.com/mobile-apps/d-4326310/microsoft-segarkan-ikon-office")
# page_content = html.read()
# with open('page_content.html', 'wb') as fid:
#      fid.write(page_content)

import scrapy

class BlogSpider(scrapy.Spider):
    name = 'blogspider'
    start_urls = ['https://blog.scrapinghub.com']

    def parse(self, response):
        for title in response.css('.post-header>h2'):
            yield {'title': title.css('a ::text').extract_first()}

        for next_page in response.css('div.prev-post > a'):
            yield response.follow(next_page, self.parse)