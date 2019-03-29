FROM mongo

COPY posts.json /posts.json

CMD mongoimport --host mongodb --db blog --collection posts --type json --file /posts.json --jsonArray

# COPY comments.json /comments.json
# CMD mongoimport --host mongodb --db blog --collection comments --type json --file /comments.json --jsonArray