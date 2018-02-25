@ECHO OFF
ECHO
ECHO *************************************************************
ECHO ******************AWS Copying Utility************************
ECHO *************************************************************
cd \
D:
cd Documents\SDEV400\seasonpics
aws s3 cp beach.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Admin/
aws s3 cp bench.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Admin/
aws s3 cp chair.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Admin/
aws s3 cp feet.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Admin/

aws s3 cp chair.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Students/
aws s3 cp happy.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Students/
aws s3 cp squirrel.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Students/
aws s3 cp watermelon.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Students/

aws s3 cp snowtree.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Faculty/
aws s3 cp summer.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Faculty/
aws s3 cp ski.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Faculty/
aws s3 cp snowman.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Faculty/



aws s3 cp snowtree.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Presentations/
aws s3 cp summer.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Presentations/
aws s3 cp ski.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Presentations/
aws s3 cp snowman.jpg s3://edu.umuc.sdev400.hw2.yanofsky/Presentations/

PAUSE
