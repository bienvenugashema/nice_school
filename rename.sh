for f in *.html; do [ -e "$f" ] && mv "$f" "${f%.html}.php"; done
