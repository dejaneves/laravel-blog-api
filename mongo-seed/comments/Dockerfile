FROM mongo

COPY comments.json /comments.json
CMD mongoimport --host mongodb --db blog --collection comments --type json --file /comments.json --jsonArray