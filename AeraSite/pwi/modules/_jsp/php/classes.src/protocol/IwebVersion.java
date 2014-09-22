/*    */ package protocol;
/*    */ 
/*    */ public class IwebVersion
/*    */ {
/*  3 */   private String version = "";
/*  4 */   private String update = "";
/*  5 */   private String comment = "";
/*  6 */   private String game = "";
/*  7 */   private String buildDate = "";
/*    */ 
/*  9 */   public String getUpdate() { return this.update; }
/*    */ 
/*    */   public void setUpdate(String update)
/*    */   {
/* 13 */     this.update = update;
/*    */   }
/*    */ 
/*    */   public String getComment() {
/* 17 */     return this.comment;
/*    */   }
/*    */ 
/*    */   public void setComment(String comment) {
/* 21 */     this.comment = comment;
/*    */   }
/*    */ 
/*    */   public String getGame() {
/* 25 */     return this.game;
/*    */   }
/*    */ 
/*    */   public void setGame(String game) {
/* 29 */     this.game = game;
/*    */   }
/*    */ 
/*    */   public String getBuildDate() {
/* 33 */     return this.buildDate;
/*    */   }
/*    */ 
/*    */   public void setBuildDate(String buildDate) {
/* 37 */     this.buildDate = buildDate;
/*    */   }
/*    */ 
/*    */   public String getVersion() {
/* 41 */     return this.version;
/*    */   }
/*    */ 
/*    */   public void setVersion(String version) {
/* 45 */     this.version = version;
/*    */   }
/*    */   public IwebVersion(String version, String update, String comment, String game, String buildDate) {
/* 48 */     this.version = version;
/* 49 */     this.update = update;
/* 50 */     this.comment = comment;
/* 51 */     this.game = game;
/* 52 */     this.buildDate = buildDate;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.IwebVersion
 * JD-Core Version:    0.6.2
 */