/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ 
/*    */ public class FactionDB
/*    */ {
/* 17 */   public static final Object locker = new Object();
/* 18 */   public static FactionClientManager mgr = new FactionClientManager();
/*    */ 
/*    */   public static void init() throws Exception
/*    */   {
/* 22 */     synchronized (mgr)
/*    */     {
/* 24 */       if (null == mgr.s)
/*    */       {
/* 26 */         Protocol.Client(mgr);
/* 27 */         mgr.wait();
/*    */       }
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.FactionDB
 * JD-Core Version:    0.6.2
 */