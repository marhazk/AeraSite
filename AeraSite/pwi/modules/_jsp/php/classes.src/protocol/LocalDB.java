/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.service.interfaces.Complain;
/*    */ import java.util.Vector;
/*    */ import org.apache.commons.logging.Log;
/*    */ import org.apache.commons.logging.LogFactory;
/*    */ 
/*    */ public class LocalDB
/*    */ {
/* 12 */   private static final Log log = LogFactory.getLog(LocalDB.class);
/* 13 */   private static LocalDB instance = new LocalDB();
/*    */ 
/* 15 */   private final int COMPLAIN_SIZE = 1000;
/* 16 */   private Vector complains = new Vector();
/*    */ 
/*    */   public static LocalDB getInstance() {
/* 19 */     return instance;
/*    */   }
/*    */ 
/*    */   public synchronized void addComplain(Complain com) {
/* 23 */     if (this.complains.size() >= 1000)
/* 24 */       log.info("complains cache overflow, discard!");
/*    */     else
/* 26 */       this.complains.add(com);
/*    */   }
/*    */ 
/*    */   public synchronized Complain[] fetchComplains()
/*    */   {
/* 31 */     Complain[] tcs = new Complain[this.complains.size()];
/* 32 */     this.complains.copyInto(tcs);
/* 33 */     this.complains.clear();
/* 34 */     return tcs;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.LocalDB
 * JD-Core Version:    0.6.2
 */