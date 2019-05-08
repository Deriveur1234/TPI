ALTER TABLE `tpi`.`role` DROP COLUMN `Name`;
INSERT INTO `tpi`.`role`
(
	`Name`
)
VALUES
(
	`Admin`
);

INSERT INTO `tpi`.`role`
(
	`Name`
)
VALUES
(
	`User`
);

INSERT INTO `tpi`.`user`
(
`Nickname`,
`Name`,
`Firstname`,
`Phone`,
`email`,
`IsConfirmed`,
`IdRole`)
VALUES
(
'Test',
'Burnand',
'Loic',
'0767786644',
'loic.brnnd@eduge.ch',
true,
1);
