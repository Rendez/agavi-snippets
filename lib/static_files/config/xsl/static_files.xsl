<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:envelope_0_11="http://agavi.org/agavi/1.0/config"
>
	<xsl:output method="xml" version="1.0" encoding="utf-8" indent="yes" />
	
	<xsl:include href="../../../../libs/agavi/config/xsl/_common.xsl" />
	
	<xsl:variable name="static_files_1_0" select="'http://company.com/projectname/config/static_files/1.0'" />
	
	<!-- pre-1.0 backwards compatibility for 1.0 -->
	<!-- non-"envelope" elements are copied to the 1.0 static files namespace -->
	<xsl:template match="envelope_0_11:*">
		<xsl:element name="{local-name()}" namespace="{$static_files_1_0}">
			<xsl:copy-of select="@*" />
			<xsl:apply-templates />
		</xsl:element>
	</xsl:template>
	
</xsl:stylesheet>