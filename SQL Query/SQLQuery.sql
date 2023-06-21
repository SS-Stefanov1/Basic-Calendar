USE [MuOnline]
GO

/****** Object:  Table [dbo].[CalendarProject]    Script Date: 06/21/2023 22:27:35 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[CalendarProject](
	[year] [int] NULL,
	[month] [int] NULL,
	[day] [int] NULL,
	[name] [nvarchar](50) NULL,
	[email] [nvarchar](50) NULL,
	[phone] [int] NULL,
	[ap_hour] [int] NULL
) ON [PRIMARY]

GO


