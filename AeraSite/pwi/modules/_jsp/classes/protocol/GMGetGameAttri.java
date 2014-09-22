/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GMGetGameAttri extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public Octets value;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     GMGetGameAttriArg arg = (GMGetGameAttriArg)argument;
/* 16 */     GMGetGameAttriRes res = (GMGetGameAttriRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     GMGetGameAttriArg arg = (GMGetGameAttriArg)argument;
/* 22 */     GMGetGameAttriRes res = (GMGetGameAttriRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = 0;
/* 27 */       this.value = res.value;
/* 28 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 34 */     synchronized (this)
/*    */     {
/* 36 */       this.retcode = 4;
/* 37 */       this.value = null;
/* 38 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMGetGameAttri
 * JD-Core Version:    0.6.2
 */