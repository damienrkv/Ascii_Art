FROM nginx:1.10.1

COPY ./ /usr/share/nginx/html/
CMD ["nginx", "-g", "daemon off;"]