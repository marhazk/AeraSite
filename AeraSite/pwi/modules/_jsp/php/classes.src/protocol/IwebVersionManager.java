/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Conf;
/*    */ import java.io.PrintStream;
/*    */ 
/*    */ public class IwebVersionManager
/*    */ {
/*    */   private IwebVersion confVersion;
/*    */   private IwebVersion localVersion;
/* 40 */   private static IwebVersionManager instance = new IwebVersionManager();
/*    */ 
/*    */   private IwebVersionManager()
/*    */   {
/*    */     try
/*    */     {
/*  8 */       Conf conf = Conf.GetInstance("/etc/iweb.conf", null);
/*  9 */       String section = "iweb";
/* 10 */       String version = conf.find(section, "version");
/* 11 */       String update = conf.find(section, "update");
/* 12 */       String game = conf.find(section, "game");
/* 13 */       String comment = conf.find(section, "comment");
/* 14 */       String buildDate = conf.find(section, "build");
/* 15 */       this.confVersion = new IwebVersion(version, update, comment, game, buildDate);
/* 16 */       System.out.println("iweb.conf version=" + version);
/* 17 */       System.out.println("iweb.conf update=" + update + ",game=" + game);
/* 18 */       System.out.println("iweb.conf comment=" + comment + ",buildDate=" + buildDate);
/*    */     } catch (Exception e) {
/* 20 */       e.printStackTrace();
/*    */     }
/*    */     try {
/* 23 */       JioConfig conf = JioConfig.GetInstance(JioConfig.class.getResource("/version.conf"), null);
/* 24 */       String section = "version";
/* 25 */       String version = conf.find(section, "version");
/* 26 */       String update = conf.find(section, "update");
/* 27 */       String game = conf.find(section, "game");
/* 28 */       String comment = conf.find(section, "comment");
/* 29 */       String buildDate = conf.find(section, "build");
/* 30 */       this.localVersion = new IwebVersion(version, update, comment, game, buildDate);
/* 31 */       System.out.println("version.conf version=" + version);
/* 32 */       System.out.println("version.conf update=" + update + ",game=" + game);
/* 33 */       System.out.println("version.conf comment=" + comment + ",buildDate=" + buildDate);
/*    */     } catch (Exception e) {
/* 35 */       e.printStackTrace();
/*    */     }
/*    */   }
/*    */ 
/*    */   public static IwebVersionManager getInstance()
/*    */   {
/* 42 */     return instance;
/*    */   }
/* 44 */   public static IwebVersion getIwebConfVersion() { return instance.confVersion; }
/*    */ 
/*    */   public static IwebVersion getVersionConfVersion() {
/* 47 */     return instance.localVersion;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.IwebVersionManager
 * JD-Core Version:    0.6.2
 */