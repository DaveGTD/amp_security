CREATE TABLE amp_customers
(
CustomerAccountId int,
City varchar(255),
Area varchar(255),
SystemName varchar(255),
SystemPackageName varchar(255),
CreditScore varchar(255),
StatusID int,
MonthlyMonitoringRate float,
QualityScore float
);


#############

LOAD DATA INFILE 'amp_cus.csv' INTO TABLE amp.amp_customers FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\n' IGNORE 1 LINES;


#############

select Area, FORMAT(avg(QualityScore),2), MIN(QualityScore), MAX(QualityScore),
Count(1) from amp_customers group by Area order by avg(QualityScore) desc;


select Area, FORMAT(avg(QualityScore),2), MIN(QualityScore), MAX(QualityScore), Count(1) from amp_customers group by Area order by avg(QualityScore) desc INTO OUTFILE '/tmp/temp_amp.csv' FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

select area, FORMAT(AVG(MonthlyMonitoringRate),3) AS avg, count(1) from amp_customers group by Area order by avg desc INTO OUTFILE '/tmp/temp_amp.csv' FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';


select Area, CreditScore, count(CreditScore) from amp_customers  group by Area, CreditScore;