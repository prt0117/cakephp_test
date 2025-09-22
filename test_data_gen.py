# Реальные данные
sources = ['google', 'facebook', 'newsletter', 'twitter', 'affiliate', 'bing', 'youtube', 'instagram', 'tiktok', 'reddit',
           'snapchat', 'linkedin', 'pinterest', 'email', 'display', 'seo', 'direct', 'referral', 'mobile', 'blog', 'forums',
           'podcasts', 'youtube_ads', 'search', 'organic', 'pay_per_click', 'influencer', 'content_marketing', 'event', 'sms']

mediums = ['cpc', 'organic', 'referral', 'email', 'social', 'banner', 'affiliate', 'paid_search', 'seo', 'influencer']

campaigns = ['summer_sale', 'black_friday', 'holiday_discount', 'winter_clearance', 'back_to_school', 'new_year_promo',
             'christmas_campaign', 'easter_special', 'flash_sale', 'thanksgiving_offer']

contents = ['banner_ad', 'video_ad', 'text_link', 'carousel_ad', 'popup', 'email_template', 'landing_page', 'social_post',
            'product_page', None]  # Добавляем None, чтобы был content = NULL

terms = ['shoes', 'laptop', 'travel', 'fitness', 'home_decor']

# Открываем файл для записи SQL
with open('utm_data_inserts.sql', 'w') as file:
    # Генерация данных
    for source in sources:
        for medium in mediums:
            for campaign in campaigns:
                for content in contents:
                    # С каждым content генерируем термины
                    for i in range(10):
                        term = terms[i] if i < 5 else None  # Последние 5 terms будут NULL

                        # Формируем SQL-INSERT
                        insert_query = f"""
                        INSERT INTO utm_data (source, medium, campaign, content, term)
                        VALUES ('{source}', '{medium}', '{campaign}', {f"'{content}'" if content else 'NULL'}, {f"'{term}'" if term else 'NULL'});
                        """

                        # Записываем в файл
                        file.write(insert_query + '\n')

print("SQL файл с данными для вставки был успешно сгенерирован: utm_data_inserts.sql")