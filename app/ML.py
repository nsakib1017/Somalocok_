# imports #
import sys
import mysql.connector

# main #
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="12345",
  database="somalocok"
)
mycursor = mydb.cursor()
a=sys.argv[1]
c="asdasdasd"
sql = "INSERT INTO genres (movie_ID, genre) VALUES (%s, %s)"
val = (a,c)
mycursor.execute(sql, val)
mydb.commit()

# 
# sql1="SELECT plot_summary FROM movies WHERE movie_ID= %s"
# val1(a,)
# mycursor.execute(sql1, val1)
# myresult = mycursor.fetchall() 
# plot_summ = myresult[0]
# 
